const state ={
    newsPosts:null,
    newsPostsStatus:null,
    postMessage:'',
};

const getters ={
    newsPosts(state) {
        return state.newsPosts;
    },
    newsStatus(state) {
        return {
            newsPostsStatus:state.newsPostsStatus
        }
    },
    postMessage(state) {
        return state.postMessage;
    }
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
    }
};

const mutations = {
    setPostsStatus(state, status) {

        state.newsPostsStatus = status;
    },

    setPosts(state, posts) {

        state.newsPosts = posts;
    },

    updateMessage(state, message) {

        state.postMessage = message;
    },

    pushPost(state,post) {

        state.newsPosts.data.unshift(post)
    },

    pushLikes(state,data) {

        state.newsPosts.data[data.postKey].data.attributes.likes = data.likes;
    }


};

export default {
    state,getters,actions,mutations
}
