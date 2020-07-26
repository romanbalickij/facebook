const state ={
    user:null,
    userStatus:null,

};

const getters ={

    user(state) {
        return state.user
    },

    friendButtonText(state,getters,rootState) {
        if(rootState.User.user.data.user_id === state.user.data.user_id) {
            return '';
        }else if (getters.friendship == null) {

            return 'Add Friend';

        }else if(getters.friendship.data.attributes.confirmed_at == null
             && getters.friendship.data.attributes.friend_id !== rootState.User.user.data.user_id) {

            return 'Pending Friend Request';
        }else if(getters.friendship.data.attributes.confirmed_at !== null) {
            return  '';
        }

        return 'Accept';

    },

    friendship(state) {
       return state.user.data.attributes.friendship;
    },

    status(state) {
        return {
            user:state.userStatus,
            post:state.postsStatus
        }
    }
};

const actions ={
    fetchUser({commit, dispatch}, userId) {

        commit('setUserStatus','loading')

        axios.get(`/api/users/${userId}`)
            .then(response => {
                commit('setUser', response.data);
                commit('setUserStatus','success');


            })
            .catch(error => {
                console.log("Error loading user")
                commit('setUserStatus','error')
            });
    },

    sendFriendRequest({commit, getters},friendId) {
        if(getters.friendButtonText !== 'Add Friend') {
            return;
        }

        axios.post('/api/friend-request',{
            friend_id:friendId
        })
            .then(response =>{
                commit('setUserFriendship',response.data)
            })
            .catch(error =>{

                console.log('Error send Friend Request')
            })
    },

    acceptFriendRequest({commit,state},userId){
        axios.post('/api/friend-request-response',{
            user_id:userId,
            status:true
        })
            .then(response => {
                commit('setUserFriendship', response.data)
            })
            .catch(error => {
                console.log('error Friend-request-response')
            })

    },

    ignoreFriendRequest({commit,state},userId){
        axios.delete('/api/friend-request-response/delete',{
            data:{
                user_id:userId
            }
        })
            .then(response => {
                commit('setUserFriendship', null)
            })
            .catch(error => {
                console.log('error Friend-request-response')
            })

    },

};

const mutations ={

    setUser(state,user) {

        state.user = user;
    },

    setUserStatus(state,status) {

        state.userStatus = status;
    },

    setUserFriendship(state,friendship){

        state.user.data.attributes.friendship = friendship;
    },


};

export default {
    state,getters,actions,mutations
}
