<!-- Modal -->
<div class="modal fade" id="CoursesModal" tabindex="-1" aria-labelledby="CoursesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CoursesModalLabel">Create a New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createCourseForm">
                    <div class="mb-3">
                        <label for="courseTitle" class="form-label">Course Title</label>
                        <input type="text" class="form-control" id="courseTitle" name="courseTitle"
                            placeholder="Enter course title" required>
                    </div>
                    <div class="mb-3">
                        <label for="courseDescription" class="form-label">Course Description</label>
                        <textarea class="form-control" id="courseDescription" name="courseDescription" rows="4"
                            placeholder="Enter course description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="courseImage" class="form-label">Course Image</label>
                        <input type="file" class="form-control" id="courseImage" name="courseImage" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="courseCategory" class="form-label">Category</label>
                        <select class="form-select" id="courseCategory" name="courseCategory" required>
                            <option selected disabled>Select category</option>
                            <option value="Technology">Technology</option>
                            <option value="Business">Business</option>
                            <option value="Design">Design</option>
                            <option value="Health">Health</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="coursePrice" class="form-label">Course Price</label>
                        <input type="number" class="form-control" id="coursePrice" name="coursePrice"
                            placeholder="Enter course price" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="createCourseForm">Create Course</button>
            </div>
        </div>
    </div>
</div>
