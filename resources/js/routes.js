import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
	routes: [
		{
			path: '/',
			name: 'index',
			component: require('./components/IndexComponent').default
		},
		// {
		// 	path: '/oficios',
		// 	name: 'oficios',
		// 	component: require('./views/Oficios').default
		// },
		// {
		// 	path: '/dictamenes',
		// 	name: 'dictamenes',
		// 	component: require('./views/Dictamenes').default
		// },
		{
			path: '/memorandums',
			name: 'memorandums',
			component: require('./components/MemorandumsComponent').default
		}
		// ,
		// {
		// 	path: '*',
		// 	component: require('./views/404').default
		// }
	],
	mode: 'history',
	scrollBehavior() {
		return {x:0, y:0}
	}
})
