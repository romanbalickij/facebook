<template>
    <div class="flex flex-col items-center">
        <div class="relative mb-8">
            <div class="w-100 h-64 overflow-hidden z-10">
                <img src="https://i.pinimg.com/originals/af/18/54/af1854b640dc6e65046e6663f0ac51a0.jpg" class="object-cover w-full">
            </div>
            <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
                <div class="w-32">
                    <img class="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg" src="https://icons-for-free.com/iconfiles/png/512/business+costume+male+man+office+user+icon-1320196264882354682.png">
                </div>
                <p class="text-2xl text-gray-100 ml-4">{{user.data.attributes.name}}</p>
            </div>

            <div class="absolute flex items-center bottom-0 right-0 mb-8 mr-12 z-20">
                <button v-if="friendButtonText"
                        class="py-1 px-3 bg-gray-200 rounded"
                        @click="$store.dispatch('sendFriendRequest',$route.params.userId)">
                    {{friendButtonText}}</button>
            </div>


        </div>

        <p v-if="postLoading">Loading...</p>
        <Post v-else v-for="post in posts.data" :post="post" :key="post.data.post_id"/>

        <p v-if="!postLoading && posts.data.length < 1">No posts found</p>
    </div>
</template>

<script>
    import Post from '../../components/Post'
    import {mapGetters} from 'vuex'

    export default {
        name: "Show",
        data:()=> {

            return {

                posts:null,
                userLoading:true,
                postLoading:true,
            }
        },

        components:{
          Post
        },

        mounted() {
            this.$store.dispatch('fetchUser', this.$route.params.userId)

            axios.get('/api/users/'+ this.$route.params.userId + '/posts')
                .then(response => {
                    this.posts   = response.data;


                })
                .catch(error => {
                    console.log('error post get')
                })
                .finally(() =>{
                    this.postLoading = false;
                })

        },

        computed:{
            ...mapGetters({
                user:'user',
                friendButtonText:'friendButtonText'
            })

        }
    }
</script>

<style scoped>

</style>
