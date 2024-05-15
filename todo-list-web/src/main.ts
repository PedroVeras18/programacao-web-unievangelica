// Importando a função createApp do pacote 'vue'
import { createApp } from 'vue'

// Importando o arquivo CSS global
import './global.css'

// Importando o componente principal da aplicação
import App from './App.vue'

// Importando os ícones Phosphor
import PhosphorIcons from '@phosphor-icons/vue'

// Importando router do vue router
import router from './router/index.ts'

// Criando uma instância do aplicativo Vue
let app = createApp(App)

// Utilizando o plugin PhosphorIcons na instância do aplicativo Vue
app.use(PhosphorIcons)
app.use(router)

// Montando o aplicativo Vue na div com o id '#app' no documento HTML
app.mount('#app')
