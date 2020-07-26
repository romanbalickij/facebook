<template>
    <div class="flex flex-col items-center" v-if="status.user === 'success' && user">
        <div class="relative mb-8">
            <div class="w-100 h-64 overflow-hidden z-10">
                <UploadableImage
                    image-width="1500"
                    image-height="300"
                    image-location="cover"
                    :user-image="user.data.attributes.cover_image"
                    classes="object-cover w-full"
                ></UploadableImage>
            </div>
            <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
                <div class="w-32">
                    <UploadableImage
                        image-width="1500"
                        image-height="300"
                        image-location="profile"
                        :user-image="user.data.attributes.profile_image"
                        classes="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg"
                    ></UploadableImage>
<!--                    <img class="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg" src="https://icons-for-free.com/iconfiles/png/512/business+costume+male+man+office+user+icon-1320196264882354682.png">-->
                </div>
                <p class="text-2xl text-gray-100 ml-4">{{user.data.attributes.name}}</p>
            </div>

            <div class="absolute flex items-center bottom-0 right-0 mb-8 mr-12 z-20">
                <button v-if="friendButtonText && friendButtonText !=='Accept'"
                        class="py-1 px-3 bg-gray-200 rounded"
                        @click="$store.dispatch('sendFriendRequest',$route.params.userId)">
                    {{friendButtonText}}
                </button>

                <button v-if="friendButtonText && friendButtonText ==='Accept'"
                        class="mr-2 py-1 px-3 bg-blue-500 rounded"
                        @click="$store.dispatch('acceptFriendRequest',$route.params.userId)">
                    Accept
                </button>

                <button v-if="friendButtonText && friendButtonText ==='Accept'"
                        class="py-1 px-3 bg-gray-400 rounded"
                        @click="$store.dispatch('ignoreFriendRequest',$route.params.userId)">
                    Ignore
                </button>
            </div>
        </div>

        <div v-if="status.post === 'loading'">Loading...</div>

        <div v-else-if="posts.data.length < 1">No posts found</div>

        <Post v-else v-for="(post, postKey) in posts.data" :post="post" :key="postKey"/>

    </div>
</template>

<script>
    import Post from '../../components/Post'
    import UploadableImage from "../../components/UploadableImage";
    import {mapGetters} from 'vuex'

    export default {
        name: "Show",

        components:{
          Post,
          UploadableImage
        },

        mounted() {
            this.$store.dispatch('fetchUser', this.$route.params.userId)
            this.$store.dispatch('fetchUserPost', this.$route.params.userId)
        },

        computed:{
            ...mapGetters({
                user:'user',
                friendButtonText:'friendButtonText',
                posts:'posts',
                status:'status'
            })

        }
    }
</script>

<style scoped>

</style>
