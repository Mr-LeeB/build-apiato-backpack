Vue.component('setup-paginate', {
    props: {
        current_page: Number,
        last_page: Number,
    },
    methods: {
        changePage(page) {
            if (page == this.current_page || page < 1 || page > this.last_page) {
                return;
            }
            if (page == 1) {
                $(".previous").addClass("disabled");
                $(".previous").removeClass("cursor-pointer");
            } else {
                $(".previous").removeClass("disabled");
                $(".previous").addClass("cursor-pointer");
            }

            if (page == this.last_page) {
                $(".next").addClass("disabled");
                $(".next").removeClass("cursor-pointer");
            } else {
                $(".next").removeClass("disabled");
                $(".next").addClass("cursor-pointer");
            }

            this.$emit('handle_change', page);
        },
        cssPagination(page) {
            if (page == this.current_page || (page == 1 && this.current_page == null)) {
                return {
                    'background-color': '#3699FF',
                    'color': 'white',
                };
            }
        },
        showPageNumber: function (page) {
            if (page < 3) return page;
            else if (page > this.last_page - 2) return page;
            else if (page == this.current_page || page == this.current_page + 1 || page == this.current_page - 1) return page;
            else return "...";
        },
        hidePageNumber: function (page) {
            if (page < 3) return true;
            else if (page > this.last_page - 2) return true;
            else if (page < this.current_page - 2 || page > this.current_page + 2) return false;
            else return true;
        }
    },
    template: `
                <div class="paginate">
                    <nav aria-label="navigation">
                        <ul class="pagination">
                            <li v-bind:class="[this.current_page == 1 ? 'page-item previous disabled' : 'page-item previous cursor-pointer']">
                                <div class="page-link" aria-label="Previous" @click="changePage(current_page-1)">
                                    <span aria-hidden="true">&laquo;</span>
                                </div>
                            </li>
                            <li class="page-item cursor-pointer" v-for="page in last_page">
                                <div class="page-link" @click="changePage(page)" :style="cssPagination(page)" v-if="hidePageNumber(page)">
                                    {{ showPageNumber(page) }}
                                </div>
                            </li>
                            <li v-bind:class="[(this.last_page != 1 && this.current_page != this.last_page) ? 'page-item cursor-pointer next' : 'page-item next disabled']">
                                <div class="page-link" aria-label="Next" @click="changePage(current_page+1)">
                                    <span aria-hidden="true">&raquo;</span>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            `,
})