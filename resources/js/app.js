import './bootstrap'

import "../images/logo.svg"

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm'
import collapse from '@alpinejs/collapse'

import app from "./modules/app"
import header from "./modules/header"
import cart from "./modules/cart"
import catalog from "./modules/catalog"
import category from "./modules/category"
import filter from "./modules/filter"
import home from "./modules/home"
import page from "./modules/page"
import product from "./modules/product"
import products from "./modules/products"
import promotions from "./modules/promotions"
import mask from '@alpinejs/mask'
import { Fancybox } from "@fancyapps/ui"
import "@fancyapps/ui/dist/fancybox/fancybox.css"

window.Fancybox = Fancybox
Fancybox.bind("[data-fancybox]")

Alpine.data('app', app)
Alpine.data('header', header)
Alpine.data('cart', cart)
Alpine.data('catalog', catalog)
Alpine.data('category', category)
Alpine.data('filter', filter)
Alpine.data('home', home)
Alpine.data('page', page)
Alpine.data('product', product)
Alpine.data('products', products)
Alpine.data('promotions', promotions)

Alpine.plugin(collapse)
Alpine.plugin(mask)

Livewire.start()
