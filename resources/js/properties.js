import { createApp } from 'vue'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import Properties from './components/Properties.vue'

const propertiesApp = createApp(Properties)
propertiesApp.use(ElementPlus)
propertiesApp.mount('#properties-wrap')
