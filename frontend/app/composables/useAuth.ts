export const useAuth = () => {
    const config = useRuntimeConfig();
    const apiBase = config.public.apiBase || ""

    const authToken = useCookie<string | null>("auth_token", { sameSite: "lax", secure: !import.meta.dev })

    const setToken = (token: string) => authToken.value = token
    const clearToken = () => authToken.value = null

    const isAuthenticated = async () => {
        if (!authToken.value) return false

        try {
            await $fetch(`${apiBase}/api/me`, {
                method: "GET",
                headers: {
                    Authorization: `Bearer ${authToken.value}`,
                    "Content-Type": "application/json"
                }
            })
            return true;
        }
        catch (error) {
            console.error("Token validation failed:", error)
            return false
        }
    }

    return {
        authToken,
        setToken,
        clearToken,
        isAuthenticated,
        apiBase
    };
}