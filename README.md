# olx-crawler

API Lumen para monitoramento de preços de produtos OLX, quando incluido o link no controller é recebido um json contendo os preços atuais do produto. Pode ser inserido no banco de dados e comparar com o preço atual, fazendo assim com que tenha sempre a diferença do que é novo ou alteração do preço

# Instalação
habilitar extensão openssl no php.ini

Executar no terminal

composer update

# modificação do controller

em URL, inserir o endereço que deseja monitorar

# Utilização

php -S localhost:8000 -t public

Chamada do endpoint /listitems 
