.SILENT:

#=============VARIABLES================
node_container = front__node

ip = 192.168.198.1
#======================================

#=====MAIN_COMMAND=====================

.DEFAULT_GOAL := init

.PHONY: init
init: down-clear build up_docker ps info

.PHONY: up
up: up_docker info

.PHONY: info
info: ps info_domen

.PHONY: rebuild
rebuild: down build up_docker info

.PHONY: up_docker
up_docker:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down --remove-orphans

# флаг -v удаляет все volume (очищает все данные)
.PHONY: down-clear
down-clear:
	docker-compose down -v --remove-orphans

.PHONY: build
build:
	docker-compose build

.PHONY: ps
ps:
	docker-compose ps

.PHONY: perm
perm:
	sudo chmod 777 -R storage

#=======INFO===========================

.PHONY: info_domen
info_domen:
	echo '---------------------------------------------------------------------------------------------';
	echo '--------------------------------DEV MODE-----------------------------------------------------';
	echo http://$(ip);
	echo '---------------------------------------------------------------------------------------------';


