### Comando para iniciar contenedores Docker:

```sh
docker-compose up -d nginx mysql phpmyadmin redis workspace
```

### Comando para entrar en la shell del workspace:

```sh
docker exec -it laravel-docker-workspace-1 /bin/sh
```