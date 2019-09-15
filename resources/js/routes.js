import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
	routes: [
	{
		path: '/index',
		name: 'index',
		component: require('./components/IndexComponent').default,
		meta: {title: 'Inicio'}
	},
	{
		path: '/dashboard',
		name: '/dashboard',
		component: require('./components/IndexComponent').default,
		meta: {title: 'Dashboard'}
	},
	{
		path: '/oficios',
		name: 'oficios',
		component: require('./components/OficiosComponent').default,
		meta: {title: 'Oficios'}
	},
	{
		path: '/dictamenes',
		name: 'dictamenes',
		component: require('./components/DictamenesComponent').default,
		meta: {title: 'Dictámenes'}
	},
	{
		path: '/memorandums',
		name: 'memorandums',
		component: require('./components/MemorandumsComponent').default,
		meta: {title: 'Memorándum'}
	},
	{
		path: '*',
		component: require('./views/404').default,
		title: 'Página no encontrada'
	}
	],
	mode: 'history',
	scrollBehavior() {
		return {x:0, y:0}
	}
})
