# 🎬 Jetxd

> Aplicativo de streaming desenvolvido com **Vue 3** (frontend) e **Laravel 8** (backend), utilizando o padrão **REST API**.  
> O objetivo do projeto é construir uma base sólida para aplicações modernas separando completamente o frontend do backend.

---

## 🧩 Stack Principal

| Camada | Tecnologia | Descrição |
|:--------|:------------|:------------|
| Frontend | [Vue 3](https://vuejs.org/) + [Pinia](https://pinia.vuejs.org/) + [Tailwind CSS](https://tailwindcss.com/) | Interface moderna e reativa |
| Backend | [Laravel 8.75](https://laravel.com/) | API REST que serve os dados |
| Banco de Dados | MySQL / SQLite (configurável) | Armazena as mídias do catálogo |
| Comunicação | [Axios](https://axios-http.com/) | Comunicação HTTP entre frontend e backend |
| Utilitário | [Lodash](https://lodash.com/) | Busca otimizada com debounce |

---

## 🧠 COMO USAR
1 -> npm install
2 -> composer install
3 -> altere o env com as credenciais de api da Stripe
4 -> Com a cli do stripe baixado, utilizar: stripe listen --forward-to http://localhost:8000/api/stripe/webhook (ou para qualquer que seja sua rota)
