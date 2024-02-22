<?php include $this->resolve('partials/_header.php'); ?>
<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <form method="POST" class="grid grid-cols-1 gap-6">
        <!-- Email -->
        <label class="block">
            <span class="text-gray-700">Email address</span>
            <input name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com" />
            <?php if (array_key_exists('email', $errors)) :  ?>
                <?php foreach ($errors['email'] as $error) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo escape($error); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </label>
        <!-- Age -->
        <label class="block">
            <span class="text-gray-700">Age</span>
            <input type="number" name="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php if (array_key_exists('age', $errors)) :  ?>
                <?php foreach ($errors['age'] as $error) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo escape($error); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </label>
        <!-- Country -->
        <label class="block">
            <span class="text-gray-700">Country</span>
            <select name="country" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="USA">USA</option>
                <option value="Canada">Canada</option>
                <option value="Mexico">Mexico</option>
                <option value="Invalid">Invalid Country</option>
            </select>
            <?php if (array_key_exists('country', $errors)) :  ?>
                <?php foreach ($errors['country'] as $error) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo escape($error); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </label>
        <!-- Social Media URL -->
        <label class="block">
            <span class="text-gray-700">Social Media URL</span>
            <input name="socialMediaUrl" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php if (array_key_exists('socialMediaUrl', $errors)) :  ?>
                <?php foreach ($errors['socialMediaUrl'] as $error) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo escape($error); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </label>
        <!-- Password -->
        <label class="block">
            <span class="text-gray-700">Password</span>
            <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php if (array_key_exists('password', $errors)) :  ?>
                <?php foreach ($errors['password'] as $error) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo escape($error); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </label>
        <!-- Confirm Password -->
        <label class="block">
            <span class="text-gray-700">Confirm Password</span>
            <input type="password" name="confirmPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
            <?php if (array_key_exists('confirmPassword', $errors)) :  ?>
                <?php foreach ($errors['confirmPassword'] as $error) : ?>
                    <div class="bg-gray-100 mt-2 p-2 text-red-500">
                        <?php echo escape($error); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </label>
        <!-- Terms of Service -->
        <div class="block">
            <div class="mt-2">
                <div>
                    <label class="inline-flex items-center">
                        <input name="tos" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" type="checkbox" />
                        <span class="ml-2">I accept the terms of service.</span>
                        <?php if (array_key_exists('tos', $errors)) :  ?>
                            <?php foreach ($errors['tos'] as $error) : ?>
                                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                                    <?php echo escape($error); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
            Submit
        </button>
    </form>
</section>

<?php include $this->resolve('partials/_footer.php'); ?>