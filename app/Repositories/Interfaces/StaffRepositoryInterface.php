<?php

namespace App\Repositories\Interfaces;

interface StaffRepositoryInterface
{
    /**
     * Get all staff records.
     *
     * @return mixed
     */
    public function all();

    /**
     * Find a staff record by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create a new staff record.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update a staff record by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete a staff record by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id);
}
