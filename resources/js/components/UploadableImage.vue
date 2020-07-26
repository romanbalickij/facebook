<template>
<div>
    <img
        :src="'/' + userImage.data.attributes.path"
        ref="userImage"
        :class="classes">
</div>
</template>
<!--https://i.pinimg.com/originals/af/18/54/af1854b640dc6e65046e6663f0ac51a0.jpg-->
<script>
    import Dropzone from 'dropzone';
    import { mapGetters } from 'vuex';
    export default {
        name: "UploadableImage",

        props:[
            'userImage',
            'imageWidth',
            'imageHeight',
            'imageLocation',
            'classes'
        ],

        data() {
            return {
                dropzone:null,
            }
        },


        mounted() {
            if (this.authUser.data.user_id.toString() === this.$route.params.userId) {
                this.dropzone = new Dropzone(this.$refs.userImage, this.settings);
            }
        },

        computed:{
            ...mapGetters({
                authUser: 'authUser',
            }),
            settings(){
                return {
                    paramName:'image',
                    url:'/api/user-images',
                    acceptedFiles:'image/*',
                    params:{
                        'width':this.imageWidth,
                        'height':this.imageHeight,
                        'location':this.imageLocation,
                    },
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content,
                    },
                    success:(e,res) =>{
                        this.$store.dispatch('fetchAuthUser')
                        this.$store.dispatch('fetchUser', this.$route.params.userId);
                        this.$store.dispatch('fetchUserPost', this.$route.params.userId);
                    }
                }

            }
        },
    }
</script>

<style scoped>

</style>

