window.fromproducts = (props) => ({
    path: [],
    category: 1,
    page: 1,
    categories: [],
    products: [],
    ads: props.slice(),
    added: props.slice(),

    goBack() {
        this.path.length && this.getCategories(this.path[this.path.length - 1])
    },

    getCategories(parentId) {
        var that = this;
        that.category = parentId;
        axios.get('/admin/fromproducts/categories?parent_id=' + parentId)
            .then(function (response) {
                // console.log(response);
                that.path = response.data.path
                that.categories = response.data.categories
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .finally(function () {
                // always executed
            });
    },

    save() {
        this.added = this.ads.slice()
    },

    addProduct(product) {
        this.ads.findIndex(function (p) {
            return p.id === product.id
        }) < 0 && this.ads.push(product)
    },

    rmProduct(product) {
        var pdx = this.ads.findIndex(function (p) {
            return p.id === product.id
        })
        pdx > -1 && this.ads.splice(pdx, 1)
    },

    addAll() {
        for (product of this.products.data) this.addProduct(product)
    },

    rmAll() {
        for (product of this.products.data) this.rmProduct(product)
    },

    followLink(url) {
        var url = url.split('page=');
        this.page = url[1];
        this.getProducts()
    },

    getProducts() {
        var that = this;
        axios.get('/admin/fromproducts/products?category_id=' + that.category + '&page=' + that.page)
            .then(function (response) {
                console.log(response.data.products);
                that.products = response.data.products
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .finally(function () {
                // always executed
            });
    },

    init(data) {
        console.log(data)
        var that = this;
        this.getCategories(1)
        that.getProducts();
        this.$watch('category', function () {
            that.getProducts();
        })
    }
})