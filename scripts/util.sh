#!/bin/bash
#
# A utility for spining up postgres and/or mysql. Used for practice and to check
# SQL for assignments.
#


main() (
    # Var
    export postgreshost=postgres-scratch
    export mysqlhost=mysql-scratch
    export mysqlport=3307
    export auth=scratch
    export xampphost=xampp-scratch

    # Run
    for command in "$@"; do
        case $command in
            xampp) run_xampp ;;
            [0-9]) sleep "$command" ;;
            connect_mysql) connect_mysql ;;
            c|connect|connect_postgres) connect_postgres ;;
            p|postgres) db_postgres ;;
            m|mysql) db_mysql ;;
            clean) clean ;;
        esac
    done
)


connect_postgres() {
    docker run \
        --rm \
        --tty \
        --interactive \
        --network "$auth" \
        --name "${postgreshost}_client" \
        --mount "type=bind,source=$PWD,target=/PWD" \
        --env "PGPASSWORD=$auth" \
        postgres:latest psql \
            -h "$postgreshost" \
            -U "$auth" \
            -d "$auth"
}


connect_mysql() {
    # docker run \
    #     --rm \
    #     --name "${mysqlhost}_client" \
    #     --interactive \
    #     --tty \
    #     --network "$auth" \
    #     mysql mysql \
    #         --host="$mysqlhost" \
    #         --database="$auth" \
    #         --user="$auth" \
    #         --password="$auth"

    # Below connects via root account
    docker run \
        --rm \
        --name "${mysqlhost}_client" \
        --interactive \
        --tty \
        --network "$auth" \
        mysql mysql \
            --host="$mysqlhost" \
            --database="$auth" \
            --user="root" \
            --password="$auth"
}


db_postgres() {
    network_create
    docker run \
        --restart unless-stopped \
        --detach \
        --publish 5432:5432 \
        --network "$auth" \
        --name "$postgreshost" \
        --env "POSTGRES_USER=$auth" \
        --env "POSTGRES_PASSWORD=$auth" \
        --env "POSTGRES_DB=$auth" \
        --env "PGDATA=/data" \
        postgres:latest
}


db_mysql() {
    network_create
    docker run \
        --restart unless-stopped \
        --detach \
        --network "$auth" \
        --publish "${mysqlport}:3306" \
        --name "$mysqlhost" \
        --env "MYSQL_ROOT_PASSWORD=$auth" \
        --env "MYSQL_DATABASE=$auth" \
        --env "MYSQL_USER=$auth" \
        --env "MYSQL_PASSWORD=$auth" \
        mysql:latest
}


clean() {
    docker rm -f ${postgreshost}{,_client} ${mysqlhost}{,_client}
    docker rm -f "$xampphost"
    docker network rm "$auth"
}


network_create() {
    docker network create "$auth"
}


run_xampp() {
    docker run \
        --restart unless-stopped \
        --detach \
        --name "$xampphost" \
        --publish 41061:22 \
        --publish 41062:80 \
        --mount "type=bind,source=${PWD}/app,target=/www" \
        tomsik68/xampp:latest
}


[[ ${BASH_SOURCE[0]} == $0 ]] && main "$@"
