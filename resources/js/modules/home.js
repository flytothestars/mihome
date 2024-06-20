import axios from 'axios';
import Swiper from 'swiper/bundle';

export default (props) => ({

  populars: [],
  popularsFiltered: [],
  popularCategories: [],
  popularCategories: [],
  popularCategory: null,
  popularsSwiper: null,

  initPopulars(value = false) {
    var that = this

    if (value) {
      that.popularsFiltered = that.populars.filter(el => el.tag && el.tag.slug === value.slug)
    } else {
      that.popularsFiltered = that.populars
    }

    that.popularsSwiper && that.popularsSwiper.destroy();

    that.popularsSwiper = new Swiper(that.$refs.populars, {
      loop: false,
      navigation: {
        nextEl: '.swiper-next2',
        prevEl: '.swiper-prev2',
      },
      autoplay: that.popularsFiltered.length < 6 ? false : {
        delay: 5000,
      },
      slidesPerView: 2,
      spaceBetween: 15,
      breakpoints: {
        640: {
          slidesPerView: 3,
        },
        960: {
          slidesPerView: 4,
        },
        1480: {
          slidesPerView: 6,
        },
      }
    });
  },

  init() {

    var that = this
    axios
      .get('/populars')
      .then((response) => {
        that.populars = response.data.populars
        let tags = response.data.populars.map(el => el.tag ? el.tag.slug : null)
        let newSet = new Set(tags);
        tags = Array.from(newSet);
        let popularCategories = [];
        tags.map((slug) => {
          if (!slug) return
          let cat = response.data.populars.find(el => el.tag && el.tag.slug === slug);
          popularCategories.push(cat.tag)
        })
        that.popularCategories = popularCategories;
        that.popularsFiltered = that.populars;
      })
    this.$watch('popularCategory', function (value) {
      that.initPopulars(value);
    })
    this.initPopulars();

    new Swiper(this.$refs.banners, {
      loop: true,
      navigation: {
        nextEl: '.swiper-next',
        prevEl: '.swiper-prev',
      },
      autoplay: {
        delay: 5000,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      slidesPerView: 1,
    });

    for (let key in Array(10).fill(null)) {
      if (this.$refs[`favorites[${key}]`])

        new Swiper(this.$refs[`favorites[${key}]`], {
          loop: false,
          navigation: {
            nextEl: `.swiper-next-favorite-${key}`,
            prevEl: `.swiper-prev-favorite-${key}`,
          },
          // autoplay: {
          //   delay: 5000,
          // },
          slidesPerView: 2,
          spaceBetween: 15,
          breakpoints: {
            640: {
              slidesPerView: 2,
            },
            960: {
              slidesPerView: this.$refs[`favorites[${key}]`].classList.contains('with-product') ? 2 : 3,
            },
            1480: {
              slidesPerView: this.$refs[`favorites[${key}]`].classList.contains('with-product') ? 4 : 5,
            },
          }
        });

    }

    new Swiper(this.$refs.latests, {
      loop: false,
      navigation: {
        nextEl: '.swiper-next-latest',
        prevEl: '.swiper-prev-latest',
      },
      // autoplay: {
      //   delay: 5000,
      // },
      slidesPerView: 2,
      spaceBetween: 15,
      breakpoints: {
        640: {
          slidesPerView: 3,
        },
        960: {
          slidesPerView: 4,
        },
        1480: {
          slidesPerView: 6,
        },
      }
    });

    new Swiper(this.$refs.advantages, {
      loop: false,
      navigation: {
        nextEl: '.swiper-next3',
        prevEl: '.swiper-prev3',
      },
      // autoplay: {
      //   delay: 5000,
      // },
      slidesPerView: 1,
      spaceBetween: 15,
      breakpoints: {
        640: {
          slidesPerView: 3,
        },
        1480: {
          slidesPerView: 5,
        },
      }
    });

  }
})
