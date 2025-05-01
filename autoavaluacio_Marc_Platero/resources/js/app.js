import './bootstrap';

import * as bootstrap from 'bootstrap'
import { createApp } from 'vue'
import moduls from './components/Moduls.vue'
import resultatsAprenentatge from './components/ResultatsAprenentatge.vue'
import veureAutoavaluacions from './components/VeureAutoavaluacions.vue'

createApp(moduls).mount('#moduls')
createApp(resultatsAprenentatge).mount('#resultatsAprenentatge')
createApp(veureAutoavaluacions).mount('#veureAutoavaluacions')