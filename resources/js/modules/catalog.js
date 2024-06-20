import axios from "axios";

export default (props) => ({
    categories: [],
    category: null,
    subcategory: null,
    products: [],
    timeout: 0,
    delay: 500,
    async init() {
        let that = this;
        that.categories = props
        if (that.categories.length && !that.mobile) that.category = that.categories[0]
        let { data } = await axios.get('/autocomplete', {
            params: {
                c: 0,
                catalog: true
            }
        })
        that.products = data.products ? data.products.hits : []

        that.$watch('category', function (value) {
            clearTimeout(that.timeout)
            if (value) that.timeout = setTimeout(async function () {
                let { data } = await axios.get('/autocomplete', {
                    params: {
                        c: value.id,
                        catalog: true
                    }
                })
                that.products = data.products ? data.products.hits : []
            }, that.delay)
        })
        that.$watch('subcategory', function (value) {
            clearTimeout(that.timeout)
            if (value) that.timeout = setTimeout(async function () {
                let { data } = await axios.get('/autocomplete', {
                    params: {
                        c: value.id,
                        catalog: true
                    }
                })
                that.products = data.products ? data.products.hits : []
            }, that.delay)
        })
    }
})
