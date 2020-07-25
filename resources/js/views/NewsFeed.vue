<template>
    <div class="flex flex-col items-center py-4">

        <NewPost></NewPost>

        <p v-if="newsStatus.newsPostsStatus === 'loading'">Loading...</p>

        <Post v-else v-for="(post, postKey) in posts.data" :post="post" :key="postKey"/>

    </div>
</template>

<script>
    import NewPost from "../components/NewPost";
    import Post from "../components/Post";
    import {mapGetters} from 'vuex';

    export default {
        name: "NewsFeed",

        components:{
            NewPost,
            Post,
        },
        mounted() {
            this.$store.dispatch('fetchNewsPosts');
        },

        computed:{
            ...mapGetters({
                posts:'newsPosts',
                newsStatus:'newsStatus',
            })
        }

    }
</script>

<style scoped>

</style>
