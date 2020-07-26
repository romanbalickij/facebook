const state ={
    posts:null,
    newsPostsStatus:null,
    postMessage:'',
};

const getters ={
    newsPosts(state) {
        return state.posts;
    },
    newsStatus(state) {
        return {
            newsPostsStatus:state.newsPostsStatus
        }
    },
    postMessage(state) {
        return state.postMessage;
    },
    posts: state => {
        return state.posts;
    },
};

const actions ={

    fetchNewsPosts({commit, state}) {

        commit("setPostsStatus",'loading')

        axios.get('/api/posts/')
            .then(response => {

                commit("setPosts", response.data)
                commit("setPostsStatus", 'success')

            })
            .catch(error => {
                commit("setPostsStatus", 'error')
                console.log('error post get')
            })
    },

    postMessage({commit, state}) {

        commit("setPostsStatus",'loading')

        axios.post('api/posts',{

            body:state.postMessage
        })
            .then(response =>{

                commit('pushPost', response.data);
                commit("updateMessage", '')
                commit("setPostsStatus",'success')
            })
            .catch(error => {
               // commit("setPostsStatus", 'error')
                console.log('error send post')
            })
    },

    likePost({commit, state},data) {

        axios.post(`/api/posts/${data.postId}/like`)
            .then(response =>{

                commit('pushLikes', {
                    likes:response.data,
                    postKey:data.postKey
                })

            })
            .catch(error =>{
                console.log('error like post')
            })
    },

    commentPost({commit,state}, data){

        axios.post('/api/posts/' + data.postId + '/comment', {
            body:data.body

        })
            .then(response =>{

                commit('pushComments', {
                    comments:response.data,
                    postKey:data.postKey,
                });

            }).catch(error =>{
              console.log('error  send post');
        })
    },

    fetchUserPost({commit,state},userId) {

        commit('setPostsStatus', 'loading')

        axios.get('/api/users/'+ userId + '/posts')
            .then(response => {

                commit('setPosts', response.data)
                commit('setPostsStatus','success');
            })
            .catch(error => {
                console.log('error post get')
                commit('setPostsStatus','error');
            });
    }
};

const mutations = {
    setPostsStatus(state, status) {

        state.newsPostsStatus = status;
    },

    setPosts(state, posts) {

        state.posts = posts;
    },

    updateMessage(state, message) {

        state.postMessage = message;
    },

    pushPost(state,post) {

        state.posts.data.unshift(post)
    },

    pushLikes(state,data) {

        state.posts.data[data.postKey].data.attributes.likes = data.likes;
    },

    pushComments(state,data) {

        state.posts.data[data.postKey].data.attributes.comments = data.comments;

    }


};

export default {
    state,getters,actions,mutations
}
