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
		path: '/perfil',
		name: 'perfil',
		component: require('./components/PerfilUsuarioComponent').default,
		meta: {title: 'Memorándum'}
	},
	{
		path: '/usuarios',
		name: 'usuarios',
		component: require('./components/AdminUsuariosComponent').default,
		meta: {title: 'Usuarios'}
	},
	{
		path: '/roles',
		name: 'roles',
		component: require('./components/RolesComponent').default,
		meta: {title: 'Roles'}
	},
	{
		path: '/permisos',
		name: 'permisos',
		component: require('./components/PermisosComponent').default,
		meta: {title: 'Permisos'}
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
