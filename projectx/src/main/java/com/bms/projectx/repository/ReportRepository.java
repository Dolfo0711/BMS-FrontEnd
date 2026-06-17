package com.bms.projectx.repository;

import com.bms.projectx.entity.ReportEntity;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface ReportRepository
        extends JpaRepository<ReportEntity, Long> {

    List<ReportEntity> findByUserId(Long userId);

}