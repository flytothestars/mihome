<div class="uk-margin-large-top">
    <div class="uk-margin-small uk-grid-small uk-grid" uk-grid="">
        <div class="uk-width-auto uk-first-column">
            <span uk-icon="icon: user; ratio: 1" class="uk-icon">
                <!-- <svg width="20" height="20" viewBox="0 0 20 20">
                    <circle fill="none" stroke="#000" stroke-width="1.1" cx="9.9" cy="6.4" r="4.4"></circle>
                    <path fill="none" stroke="#000" stroke-width="1.1"
                        d="M1.5,19 C2.3,14.5 5.8,11.2 10,11.2 C14.2,11.2 17.7,14.6 18.5,19.2"></path>
                </svg> -->
            </span>
        </div>
        <div class="uk-width-expand">
            <meta itemprop="datePublished" content="11.10.2023">
                <div x-text="review.created_at"></div> 
                <span itemprop="author" class="user-name" x-text="review.name"></span> 
                <span class="user-rating" id="customer-rating"> 
                    <span>⭐ <span x-text="review.rate"></span></span> 
                </span>
        </div>
    </div>
    <div class="uk-margin-small uk-grid-small uk-grid" uk-grid="">
        <div class="uk-width-auto uk-first-column">
            <span uk-icon="icon: plus; ratio: 1" class="uk-icon">
                <!-- <svg width="20"
                        height="20" viewBox="0 0 20 20">
                        <rect x="9" y="1" width="1" height="17"></rect>
                        <rect x="1" y="9" width="17" height="1"></rect>
                </svg> -->
            </span>
        </div>
        <div class="uk-width-expand">
            <blockquote itemprop="itemreviewed">
                <div class="col-span-3" x-text="review.advantages"></div>
            </blockquote>
        </div>
    </div>
    <div class="uk-margin-small-bottom uk-grid-small uk-grid" uk-grid="">
        <div class="uk-width-auto uk-first-column">
            <span uk-icon="icon: minus; ratio: 1" class="uk-icon">
                <!-- <svg width="20" height="20" viewBox="0 0 20 20">
                    <rect height="1" width="18" y="9" x="1"></rect>
                </svg> -->
            </span>
        </div>
        <div class="uk-width-expand">
            <blockquote itemprop="itemreviewed">
                <div style="color: #444;" class="col-span-3" x-text="review.disadvantages"></div>
            </blockquote>
        </div>
    </div>
    <div class="uk-margin-small-bottom uk-grid-small uk-grid" uk-grid="">
        <div class="uk-width-auto uk-first-column">
            <span uk-icon="icon: comment; ratio: 1" class="uk-icon">
                <!-- <svg width="20" height="20" viewBox="0 0 20 20">
                    <path
                        d="M6,18.71 L6,14 L1,14 L1,1 L19,1 L19,14 L10.71,14 L6,18.71 L6,18.71 Z M2,13 L7,13 L7,16.29 L10.29,13 L18,13 L18,2 L2,2 L2,13 L2,13 Z">
                    </path>
                </svg> -->
            </span>
        </div>
        <div class="uk-width-expand">
            <blockquote itemprop="itemreviewed">
                <div class="" x-text="review.text"></div>
            </blockquote>
        </div>
    </div>
</div>