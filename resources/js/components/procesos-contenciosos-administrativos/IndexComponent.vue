<template>
	<div>
		<h1>Listado de procesos</h1>
		<ul>
			<li>
				<router-link :to="{ name: 'procesos-contenciosos-administrativos-create'}">Crear procesos</router-link>
			</li>
			<li>
				<router-link :to="{ name: 'procesos-contenciosos-administrativos-edit', params: { id: 1}}">
					Editar procesos
				</router-link>
			</li>
			<li>
				<router-link :to="{ name: 'procesos-contenciosos-administrativos-show' , params: { id: 2}}">
					Mostrar procesos
				</router-link>
			</li>
		</ul>
	</div>
</template>

<script>
	export default {
		mounted() {
			console.log('Index component')
		}
	}
</script>