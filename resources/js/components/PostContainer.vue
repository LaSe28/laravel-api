<template>
<div>
    <div class="row g-4">
        <div class="col-4" v-for="post in posts" :key="post.id">
            <div class="card h-100">
                <div class="d-flex flex-column card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <p class="card-text">{{post.content}}</p>
                    <a :href="'/posts/' + post.slug" class="btn btn-primary mt-auto">Apri</a>
                </div>
            </div>
        </div>
    </div>
    <div class="btn-container">
        <a class="btn btn-primary" :class="prevPage === null ? 'disabled':''" @click="getUrl(prevPage)" >Prev</a>
        <a class="btn btn-primary" :class="nextPage === null ? 'disabled':''" @click="getUrl(nextPage)" >Next</a>
    </div>

</div>
</template>

<script>
export default {
    name: 'PostContainer',
    data() {
        return {
            posts : [],
            nextPage : null,
            prevPage : null
        }
    },
    methods: {
        getUrl(url){
            if(url){
                }
                Axios.get(url)
                .then(res => {
                    this.posts = res.data.response.data;
                    this.nextPage = res.data.response.next_page_url;
                    this.prevPage = res.data.response.prev_page_url;
            })

        }
    },
    created(){
        this.getUrl('http://localhost:8000/api/posts')
    }
}
</script>

<style lang="scss" scoped>
    .btn-container{
        display: flex;
        justify-content: center;
        a{
            margin: 1rem;
        }
    }
</style>
