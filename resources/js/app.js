import Vue from 'vue'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import { App, plugin } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress/src'

import axios from 'axios'
import VueAxios from 'vue-axios'

import vmodal from 'vue-js-modal'

Vue.config.productionTip = false
Vue.mixin({ methods: { route: window.route } })
Vue.use(plugin)
Vue.use(PortalVue)
Vue.use(VueMeta)
Vue.use(VueAxios, axios)
Vue.use(vmodal)

InertiaProgress.init()

const el = document.getElementById('app')

new Vue({
    metaInfo: {
        titleTemplate: title => (title ? `${title} - Oazis CRM` : 'Oazis CRM'),
    },
    render: h =>
        h(App, {
            props: {
                initialPage: JSON.parse(el.dataset.page),
                resolveComponent: name =>
                    import (`@/Pages/${name}`).then(module => module.default),
            },
        }),
}).$mount(el)