import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Layout from './views/Layout';

import Deputy from './views/Deputy';
import Indemnity from './views/Indemnity';


const router = new VueRouter({
	mode:'history',
	routes:[
		{path:'/', component: Deputy},
		{path:'/verbas', component: Indemnity},
		{path:'/deputados', component: Deputy},
		
	]
})

const app = new Vue({
	el: '#app',
	components: { Layout },
	router
});
