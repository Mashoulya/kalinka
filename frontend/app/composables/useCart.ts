import type {Product} from "~/types/product";

type CartItem = {
    product: Product
    quantity: number
}

export const useCart = () => {
    const items = useState<CartItem[]>('cart', () => [])

    const addItem = (product: Product) => {
        //
    }
    return { items, addItem }
}