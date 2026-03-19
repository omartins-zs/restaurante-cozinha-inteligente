# SISTEMA COZINHA INTELIGENTE

Bem-vindo à documentação do **SISTEMA COZINHA (Kitchen OS)**. Este sistema foi desenvolvido para otimizar o fluxo de produção de uma cozinha industrial ou restaurante, integrando pedidos, controle de estoque e planejamento de compras de forma inteligente e visual.

## 🚀 Arquitetura Geral

O sistema utiliza uma arquitetura moderna e de alta performance:

- **Backend:** Laravel (PHP) gerenciando a lógica de negócios e as APIs.
- **Frontend:** React com Vite, focado em uma interface reativa e suave.
- **Estilização:** Tailwind CSS 4 para um design ultra-moderno e responsivo.
- **Animações:** Framer Motion para transições de estado e feedback visual.
- **Iconografia:** Lucide React para representação visual limpa.

---

## 💻 Funcionalidades Principais

### 1. Painel de Pedidos (Pedidos Ativos)
- Exibição de pedidos em tempo real.
- Status automatizados (**pendente**, **em progresso** ou **concluido**).
- Informações detalhadas por prato: quantidade, tempo de preparo e ingredientes principais.
- Ação rápida para marcar pedidos como concluídos.

### 2. Hub de Planejamento (Requisitos de Produção)
- Análise inteligente do impacto dos pedidos ativos no estoque atual.
- Barras de progresso visuais indicando o quanto de cada ingrediente está **comprometido** para a produção.
- Alertas visuais automáticos quando o estoque é insuficiente para atender a demanda atual.

### 3. Lista de Compras Urgente (Procurement)
- Identificação automática de itens críticos baseada nos pedidos em espera.
- Cálculo preciso da **quantidade a comprar** para suprir a necessidade imediata.
- Interface visual destacada para itens com falta de estoque.

---

## 🛠 Configuração Técnica

### Requisitos
- PHP >= 8.2
- Node.js & npm
- Laravel v11+
- React v19+

### Comandos de Desenvolvimento
Para rodar o projeto localmente:

1. **Servidor Backend:**
   ```bash
   php artisan serve
   ```

2. **Compilação Frontend (Vite):**
   ```bash
   npm run dev
   ```

### Estrutura de Pastas (Frontend)
- `resources/js/app.jsx`: Ponto de entrada e gerenciador de estado global.
- `resources/js/components/`:
    - `NavIcon.jsx`: Ícones da barra lateral com animação de indicador ativo.
    - `StatCard.jsx`: Cartões de estatísticas no cabeçalho.
    - `OrdersTab.jsx`: Interface de gerenciamento de pedidos.
    - `PlanningTab.jsx`: Visualização de estoque e compromisso de ingredientes.
    - `ShoppingListTab.jsx`: Lista dinâmica de compras.

---

## 🎨 Design System
O sistema utiliza uma paleta de cores "Neo-Industrial":
- **Base:** `#0A0A0A` (Preto profundo)
- **Acento Primário:** `#FF4D00` (Laranja vibrante para ações e alertas)
- **Superfícies:** `white/5` com `backdrop-blur` para efeito de vidro (glassmorphism).
- **Tipografia:** Inter (font-black para títulos e font-bold para dados).

---

## 📝 Próximos Passos (Roadmap)
- [ ] Implementação de WebSockets para atualizações sem refresh.
- [ ] Gráficos de performance de produção histórica.
- [ ] Gerenciamento de múltiplas praças (cozinha fria, quente, etc.).
- [ ] Interface de cadastro de receitas e insumos no painel administrativo.

---
**Desenvolvido com foco em eficiência e visual premium.**
