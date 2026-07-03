export interface Product {
    id: number
    name: string
    slug: string
    price: string
    size: {
        weightVolume: string | null
        unit: string | null
    }
    description: string
    photo: string | null
}
