CONSOLE := php bin/console

du:
	docker-compose up --build -d

duf:
	docker-compose up -d --force-recreate --remove-orphans

dd:
	docker-compose down

dep:
	docker-compose exec php bash

ded:
	docker-compose exec db bash

deh:
	docker-compose exec httpd bash


m:
	$(CONSOLE) doctrine:migrations:migrate latest

mn:
	$(CONSOLE) doctrine:migrations:migrate next

mp:
	$(CONSOLE) doctrine:migrations:migrate prev

md:
	$(CONSOLE) doctrine:migrations:diff


csa:
	$(CONSOLE) sonata:user:create admin admin@admin.ru admin --super-admin
