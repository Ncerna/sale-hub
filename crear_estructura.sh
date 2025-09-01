#!/bin/bash

# Ya estás en el directorio saleHub, por eso se comenta esta línea
# cd saleHub || { echo "Directorio saleHub no encontrado"; exit 1; }

mkdir -p app/Domain/{Entity,IRepository,IService,ValueObject}
mkdir -p app/Application/{UseCase,Service,DTOs,Command}
mkdir -p app/Infrastructure/{Persistence,ApiClients,ServiceImplementations,Framework/{Controller,Middleware,Adapters,Factories}}
mkdir -p config
mkdir -p routes
mkdir -p storage
mkdir -p tests/{Domain,Application,Infrastructure}

echo "Estructura hexagonal creada correctamente en saleHub"
