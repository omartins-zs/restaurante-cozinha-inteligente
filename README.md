# Kitchen OS - Sistema de Planejamento Inteligente de Produção

Kitchen OS é um sistema de gerenciamento de produção para cozinhas industriais e restaurantes. Ele automatiza o cálculo de ingredientes, monitora o estoque e sequencia a produção para minimizar o desperdício e otimizar o tempo.

## 🚀 Como Executar o Projeto

### Pré-requisitos
- PHP 8.3+
- Composer
- Node.js & NPM
- SQLite (ou outro driver de banco de dados suportado pelo Laravel)

### Instalação

1.  **Clone o repositório e acesse a pasta:**
    ```bash
    cd restaurante-cozinha-inteligente
    ```

2.  **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

3.  **Instale as dependências do Frontend:**
    ```bash
    npm install
    ```

4.  **Configure o ambiente:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Prepare o banco de dados e dados de demonstração:**
    ```bash
    # Cria o arquivo SQLite se necessário (config padrão)
    touch database/database.sqlite
    
    # Roda as migrações e popula com dados fakes/demo
    php artisan migrate:refresh --seed
    ```

### Execução em Desenvolvimento

Para rodar o projeto localmente, você precisa de dois terminais abertos:

**Terminal 1 (Backend):**
```bash
php artisan serve
```

**Terminal 2 (Frontend/Vite):**
```bash
npm run dev
```

O sistema estará disponível em [http://localhost:8000](http://localhost:8000).

---

## 🛠️ Tecnologias Utilizadas

-   **Backend**: Laravel 13 (Service Pattern, Eloquent, API Resources)
-   **Frontend**: React 18, Vite, Framer Motion, Tailwind CSS 4, Lucide Icons
-   **Banco de Dados**: SQLite (padrão desenvolvimento)
-   **Testes**: PHPUnit (Laravel Feature Tests)

## 📋 Funcionalidades Principais

-   **Dashboard Inteligente**: Visualização em tempo real de pedidos ativos.
-   **Cálculo de Ingredientes**: Agrega automaticamente todos os ingredientes necessários para a produção atual.
-   **Lista de Compras Automática**: Compara a necessidade com o estoque atual e gera uma lista de compras urgente.
-   **Gestão de Estoque**: Monitoramento de níveis críticos e estoque mínimo.
-   **Estimativa de Tempo**: Cálculo do tempo total de preparo baseado nas receitas sincronizadas.

## 🧪 Execução de Testes

O projeto utiliza o PHPUnit para garantir a integridade da lógica de produção e dos endpoints da API. Para rodar a suite completa:

```bash
php artisan test
```

Este comando executará os testes de Unit e Feature, incluindo os novos testes de API e do `ProductionService`.

---

## 📦 Estrutura do Projeto

-   `app/Services/ProductionService.php`: Lógica central de planejamento.
-   `app/Http/Controllers/Api/`: Controllers REST para Pedidos, Inventário e Planejamento.
-   `resources/js/`: Aplicação React com sistema de design premium.
-   `database/factories/`: Factories para geração de dados massivos de teste.
