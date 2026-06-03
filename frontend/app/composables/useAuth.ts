export const useAuth = () => {
    const config = useRuntimeConfig();
    const apiBase = config.public.apiBase || ""


    const authToken = useCookie<string | null>("auth_token", { sameSite: "lax", secure: !import.meta.dev })

    // --- PATCH DEV : synchronisation cookie <-> localStorage ---
    if (import.meta.dev) {
        // Au chargement, si cookie vide mais localStorage a le token, on restaure
        if (!authToken.value && typeof window !== 'undefined') {
            const stored = localStorage.getItem('auth_token')
            if (stored) authToken.value = stored
        }
    }

    const setToken = (token: string) => {
        authToken.value = token
        if (import.meta.dev && typeof window !== 'undefined') {
            localStorage.setItem('auth_token', token)
        }
    }
    const clearToken = () => {
        authToken.value = null
        if (import.meta.dev && typeof window !== 'undefined') {
            localStorage.removeItem('auth_token')
        }
    }

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

// export const useAuth = () => { const config = useRuntimeConfig(); const apiBase = config.public.apiBase || "" const authToken = useCookie<string | null>("auth_token", { sameSite: "lax", secure: !import.meta.dev }) const setToken = (token: string) => authToken.value = token const clearToken = () => authToken.value = null const isAuthenticated = async () => { if (!authToken.value) return false try { await $fetch(${apiBase}/api/me, { method: "GET", headers: { Authorization: Bearer ${authToken.value}, "Content-Type": "application/json" } }) return true; } catch (error) { console.error("Token validation failed:", error) return false } } return { authToken, setToken, clearToken, isAuthenticated, apiBase }; }