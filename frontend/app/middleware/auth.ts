export default defineNuxtRouteMiddleware(async () => {
    const { authToken, isAuthenticated, clearToken } = useAuth()

    if (!authToken.value) {
        return navigateTo('/login')
    }

    const authenticated = await isAuthenticated()

    if (!authenticated) {
        clearToken()
        return navigateTo('/login')
    }
})
