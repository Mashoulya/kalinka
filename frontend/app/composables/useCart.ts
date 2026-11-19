import type {Product} from "~/types/product";

export type CartItem = {
    product: Product
    quantity: number
}

export const useCart = () => {
    const items = useState<CartItem[]>('cart', () => [])

    const addItem = (product: Product, quantity: number = 1) => {
        const existingItem = items.value.find(item => item.product.id === product.id)
        if (existingItem) {
            existingItem.quantity += quantity
        } else {
            items.value.push({ product, quantity })
        }
    }

    const updateQuantity = (productId: number, quantity: number) => {
        const item = items.value.find(item => item.product.id === productId)
        if (item) {
            if (quantity <= 0) {
                removeItem(productId)
            } else {
                item.quantity = quantity
            }
        }
    }

    const removeItem = (productId: number) => {
        const index = items.value.findIndex(item => item.product.id === productId)
        if (index > -1) {
            items.value.splice(index, 1)
        }
    }

    const clearCart = () => {
        items.value = []
    }

    const total = computed(() => {
        return items.value.reduce((sum, item) => {
            const price = parseFloat(item.product.price)
            return sum + (price * item.quantity)
        }, 0)
    })

    return { items, addItem, updateQuantity, removeItem, clearCart, total }
}