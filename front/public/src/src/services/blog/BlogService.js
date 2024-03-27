import axios from 'axios';

class BlogService {
    async getPost(id) {
        try {
            const response = await axios.get(`http://localhost/api/posts/${id}`);
            return response.data.data.post;
        } catch (error) {
            console.error('Error fetching post by ID:', error);
            throw error;
        }
    }

    async getPosts(pageNumber = 1) {
        try {
            const response = await axios.get(`http://localhost/api/posts?page=${pageNumber}`);
            return response.data.data;
        } catch (error) {
            console.error('Error fetching posts:', error);
            throw error;
        }
    }

    async addLike(post_id) {
        try {
            const response = await axios.post(`http://localhost/api/posts/add_like`,post_id);
            return response.data.data;
        } catch (error) {
            console.error('Error fetching categories:', error);
            throw error;
        }
    }

    async addView(post_id) {
        try {
            const response = await axios.post(`http://localhost/api/posts/add_view`,post_id);
            return response.data.data;
        } catch (error) {
            console.error('Error fetching categories:', error);
            throw error;
        }
    }
}

export default new BlogService();
