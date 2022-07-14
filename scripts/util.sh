#!/bin/bash
#
# A utility for spining up postgres and/or mysql. Used for practice and to check
# SQL for assignments.
#

main() (
    # Var
    export postgreshost=postgres-scratch
    export mysqlhost=mysql-scratch
    export auth=scratch

    # Run
    for command in "$@"; do
        case $command in
            connect_mysql) connect_mysql ;;
            c|connect|connect_postgres) connect_postgres ;;
            p|postgres) postgres ;;
            m|mysql) mysql ;;
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
    docker run \
        --rm \
        --name "${mysqlhost}_client" \
        --interactive \
        --tty \
        --network "$auth" \
        mysql mysql \
            --host="$mysqlhost" \
            --database="$auth" \
            --user="$auth" \
            --password="$auth"
}


postgres() {
    network_create
    docker run \
        --rm \
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


mysql() {
    network_create
    docker run \
        --detach \
        --network "$auth" \
        --publish 3306:3306 \
        --name "$mysqlhost" \
        --env "MYSQL_ROOT_PASSWORD=$auth" \
        --env "MYSQL_DATABASE=$auth" \
        --env "MYSQL_USER=$auth" \
        --env "MYSQL_PASSWORD=$auth" \
        mysql:latest
}


clean() {
    docker rm -f ${postgreshost}{,_client} ${mysqlhost}{,_client}
    docker network rm "$auth"
}


network_create() {
    docker network create "$auth"
}


[[ ${BASH_SOURCE[0]} == $0 ]] && main "$@"
