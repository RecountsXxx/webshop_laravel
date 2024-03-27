import axios from 'axios';
import { useToast } from "vue-toastification";

class PostService {
    toast = useToast();

    async fetchPosts(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/admin/posts/?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            this.handleError(error, 'Error fetching posts');
        }
    }

    async addPost(formData) {
        try {
            const response = await axios.post('http://localhost/api/admin/posts', formData);
            this.toast.info('Post successfully added!');
            return response.data.data.post;
        } catch (error) {
            this.handleError(error, 'Error adding post');
        }
    }

    async getPost(id) {
        try {
            const response = await axios.get(`http://localhost/api/admin/posts/${id}`);
            return response.data.data.post;
        } catch (error) {
            this.handleError(error, 'Error getting post');
        }
    }

    async editPost(formData, id) {
        try {
            await axios.post(`http://localhost/api/admin/posts/${id}`, formData);
            this.toast.info('Post successfully edited!');
        } catch (error) {
            this.handleError(error, 'Error editing post');
        }
    }

    async deletePost(postId) {
        try {
            await axios.delete(`http://localhost/api/admin/posts/${postId}`);
            this.toast.info('Post successfully deleted!');
        } catch (error) {
            this.handleError(error, 'Error deleting post');
        }
    }

    handleError(error, message) {
        console.error(`${message}:`, error);
        const errorMessage = error.response ? error.response.data.message : 'Internal server error';
        this.toast.error(errorMessage);
    }
}

export default new PostService();
