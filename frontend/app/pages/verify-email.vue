<script setup lang="ts">
const route = useRoute()

const status = ref<'loading' | 'success' | 'error'>('loading')
const message = ref('Vérification de votre email en cours...')

const verifyEmail = async () => {
	try {
		const response = await $fetch<{ message?: string }>('/api/verify/email', {
			method: 'GET',
			query: route.query,
		})

		status.value = 'success'
		message.value = response.message || 'Votre email a bien été vérifié.'
	} catch (error: any) {
		status.value = 'error'
		message.value = error?.data?.error || 'Le lien de vérification est invalide ou a expiré.'
	}
}

onMounted(() => {
	verifyEmail()
})
</script>

<template>
	<section class="text-center py-10 px-5 md:px-20 md:py-20">
		<h1 class="text-red-light text-3xl font-bold text-center mb-14 md:text-5xl">
			{{ status === 'success' ? 'Email vérifié !' : status === 'error' ? 'Vérification impossible' : 'Vérification en cours...' }}
		</h1>

		<p class="font-medium">
			{{ message }}
		</p>

		<BaseButton to="/" class="mt-10 inline-block">
			Retour à l'accueil
		</BaseButton>
	</section>
</template>