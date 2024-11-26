<!-- Delete link for a user -->
<a href="delete_user.php?id=<?php echo $user['user_id']; ?>" onclick="return confirmDelete();">Delete User</a>

<script>
    // JavaScript confirmation before deletion
    function confirmDelete() {
        return confirm("Are you sure you want to delete this?");
    }
</script>
