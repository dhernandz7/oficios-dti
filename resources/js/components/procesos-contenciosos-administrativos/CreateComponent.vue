<template>
	<div>
		<h1>Crear proceso</h1>
		<router-link :to="{ name: 'procesos-contenciosos-administrativos'}">Volver</router-link>
	</div>
</template>

<script>
	export default {
		mounted() {
			console.log('Create component')
		}
	}
</script>