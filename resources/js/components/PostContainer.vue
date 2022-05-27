<template>
<div>
    <div class="row g-4">
        <div class="col-4" v-for="post in posts" :key="post.id">
            <div class="card h-100">
                <div class="d-flex flex-column card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <p class="card-text">{{post.content}}</p>
                    <a :href="'/posts/' + post.slug" class="btn btn-primary mt-auto">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a class="btn" >Next</a>
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
    created(){
        Axios.get('http://localhost:8000/api/posts')
        .then(res => {
            this.posts = res.data.response.data
            this.nextPage = res.data.response.next_page_url
        })
    }

}
</script>

<style>

</style>
