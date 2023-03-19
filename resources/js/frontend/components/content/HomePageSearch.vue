<template>
    <section class="homepage-search">
        <div class="container container--medium">
            <div class="homepage-search__wrapper">
                <h2 class="homepage-search__heading">Bạn tìm gì hôm nay?</h2>
                <div class="homepage-search__inner">
                    <form action="/spotlight" method="GET"><input type="text" name="keyword"
                          placeholder="Hãy thử bắt đầu với &quot;Quần đen&quot; xem sao"
                          rel-script="spotlight-search-control-home"
                          class="homepage-search__control">
                    </form>
                    <div class="homepage-search__spotlight">
                        <div rel-script="spotlight-search-home" class="homepage-search__spotlight-content">
                            <img src="https://www.coolmate.me/images/icons/loading.svg" class="loading">
                        </div>
                        <a href="#" class="homepage-search__more">Xem toàn bộ kết quả</a>
                    </div>
                </div>
                <div class="homepage-search__content">
                    <p class="homepage-search__description">Hãy thử tìm bất kỳ từ khoá nào nhé. hadovn gợi ý nè:</p>
                    <div class="homepage-search__buttons"><a href="#" rel-script="homepage-search-button" class="homepage-search__button">áo thun</a>
                        <a href="#" rel-script="homepage-search-button" class="homepage-search__button">hoodie</a>
                        <a href="#" rel-script="homepage-search-button" class="homepage-search__button">oversize</a>
                        <a href="#" rel-script="homepage-search-button" class="homepage-search__button">cm24</a>
                        <a href="#" rel-script="homepage-search-button" class="homepage-search__button">promax</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "HomePageSearch"
    }
</script>

<style scoped>

</style>
