# loja_otica

Projeto simples de vitrine para a Óticas Alamanda. Agora utiliza as tabelas do
banco de dados de produção e traz os produtos cadastrados na tabela
`PRODUTO`.

O site possui carrinho de compras, cadastro e login de usuários e gera
pedidos na tabela `PEDIDO_ECOMMERCE`.

## Configuração de banco de dados

Os parâmetros de conexão estão definidos em `config.php` e já apontam
para o servidor MySQL utilizado pela aplicação.

Caso um produto não possua a imagem armazenada localmente, o site exibe
um placeholder (`assets/images/placeholder.svg`).


## Provador Virtual

A página `tryon.php` permite testar um par de óculos utilizando a câmera do dispositivo. O modelo usado é `assets/images/glasses-1-.glb`, que pode ser substituído por outros conforme necessidade. Para acessar, clique em **Provador** no menu superior ou no botão **Provar** presente em cada produto.
Se o navegador oferecer suporte à API FaceDetector, os óculos são posicionados automaticamente sobre o rosto.

