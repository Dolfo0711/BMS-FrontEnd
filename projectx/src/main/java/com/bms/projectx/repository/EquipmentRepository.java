package com.bms.projectx.repository;

import com.bms.projectx.entity.EquipmentEntity;
import org.springframework.data.jpa.repository.JpaRepository;

public interface EquipmentRepository
        extends JpaRepository<EquipmentEntity, Long> {
}