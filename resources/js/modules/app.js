import axios from "axios";
import Swiper from 'swiper/bundle';

export default (props) => ({
    cartText: "",
    bodycover: false,
    catalogShow: false,
    searching: false,
    mobile: window.innerWidth < 960,
    init() {
        let that = this;
        that.$watch('catalogShow', function (value) {
            if (value) that.searching = false
        })
        that.$watch('searching', function (value) {
            if (value) {
                that.catalogShow = false
            } else {
            }
        })
        that.$watch('mobile', function (value) {
            console.log(value)
        })
        if (this.$refs.advs) {
            new Swiper(this.$refs.advs, {
                loop: false,
                slidesPerView: 1,
                spaceBetween: 15,
                breakpoints: {
                    640: {
                        slidesPerView: this.$refs.advs.dataset.count,
                    }
                }
            });
        }
        new Swiper(this.$refs.footers, {
            loop: true,
            navigation: {
              nextEl: '.swiper-nextfooter',
              prevEl: '.swiper-prevfooter',
            },
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
            // slidesPerView: 5,
            slidesPerView: 1,
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
    }
})
