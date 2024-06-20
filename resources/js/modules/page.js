import Swiper from 'swiper/bundle';

export default (props) => ({
  // reviews: [],
  // allReviews: [],
  // expert_id: null,
  // reviewGroups: [],
  // imageReviews: [],
  // imageReviewSwiper: null,
  // limit: 15,
  // loadReviews(url) {
  //   var that = this;
  //   axios(url)
  //     .then(({ data }) => {
  //       that.reviews = data.data.items;
  //       that.meta = data.meta;
  //       that.links = data.links;
  //     })
  // },
  // addReviews(url) {
  //   url += `&limit=${this.limit}`;
  //   if (this.expert_id) {
  //     url += `&expert=${this.expert_id}`;
  //   }
  //   var that = this;
  //   axios(url)
  //     .then(({ data }) => {
  //       that.reviews = that.reviews.concat(data.data.items);
  //       that.meta = data.meta;
  //       that.links = data.links;
  //     })
  // },
  // helped(review) {
  //   return review.status === 'ok' ? 'Помог' : (review.status === 'bad' ? 'Не помог' : 'Пока не понятно');
  // },
  // calculateReviews() {
  //   this.reviewGroups = this.allReviews.reduce((acc, review) => {
  //     const stars = review.stars;
  //     if (!acc[stars]) {
  //       acc[stars] = [];
  //     }
  //     acc[stars].push(review);
  //     return acc;
  //   }, {});

  //   for (let star = 1; star <= 5; star++) {
  //     if (!this.reviewGroups[star]) {
  //       this.reviewGroups[star] = [];
  //     }
  //   }
  // },
  // getReviewCount(star) {
  //   return this.reviewGroups[star].length || 0;
  // },
  // getReviewPercentage(star) {
  //   const count = this.getReviewCount(star);
  //   return ((count / this.allReviews.length) * 100 || 0).toFixed(2);
  // },
  // dashArray() {
  //   return this.getMiddleStars() * 80;
  // },
  // getMiddleStars() {
  //   const totalStars = this.allReviews.reduce((acc, review) => acc + review.stars, 0);
  //   const middleStars = totalStars / this.allReviews.length;
  //   return middleStars.toFixed(2);
  // },
  init() {
    // this.imageReviews = [...props.imageReviews];
    // this.allReviews = [...props.allReviews];
    // this.calculateReviews();
    // this.expert_id = props.id;
    // let url = app.routes['reviews.index'] + `?page=1&limit=${this.limit}`;
    // if (this.expert_id) {
    //   url += `&expert=${this.expert_id}`;
    // }
    // this.loadReviews(url);
    // this.imageReviewSwiper = 
    new Swiper(this.$refs.banners, {
      loop: true,
      navigation: {
        nextEl: '.swiper-next',
        prevEl: '.swiper-prev',
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      slidesPerView: 1,
      // spaceBetween: 15,
      // breakpoints: {
      //   499: {
      //     slidesPerView: 3,
      //     spaceBetween: 15,
      //   },
      //   999: {
      //     slidesPerView: 5,
      //     spaceBetween: 15,
      //   },
      // }
    });
  }
})
