<template>
	<div>
		<h1>Mostrar proceso</h1>
		<router-link :to="{ name: 'procesos-contenciosos-administrativos'}">Volver</router-link>
	</div>
</template>

<script>
	export default {
		mounted() {
			console.log('Show component')
		}
	}
</script>