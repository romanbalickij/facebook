<template>
    <div class="flex flex-col items-center py-4">
        <NewPost></NewPost>
        <p v-if="loading">Loading...</p>
        <Post v-else v-for="post in posts.data" :post="post" :key="post.data.post_id"/>

    </div>
</template>

<script>
    import NewPost from "../components/NewPost";
    import Post from "../components/Post";

    export default {
        name: "NewsFeed",

        components:{
            NewPost,
            Post,
        },
        data:() => {
            return {
                posts:[],
                loading:true,
            }
        },

        mounted() {
            axios.get('/api/posts/')
            .then(response => {
                this.posts   = response.data;
                this.loading = false;

            })
            .catch(error => {
                console.log('error post get')
            })
        }
    }
</script>

<style scoped>

</style>
