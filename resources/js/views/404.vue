<template>
	<div class="row justify-content-center">
		<div class="col-md-12 text-center">
			<span class="display-1 d-block">Error 404</span>
			<div class="mt-5 mb-4 lead">La página que solicitó no fue encontrada.</div>
			<a @click="$router.go(-1)" href="#regresar" class="btn btn-outline-primary">Regresar</a>
		</div>
	</div>
</template>
<style scoped>
	.page-wrap {
		min-height: 100vh;
	}
	.display-1{
		background: red;
		color: white;
	}
</style>