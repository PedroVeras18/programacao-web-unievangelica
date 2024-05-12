import { CreateCarUseCase } from '../create-car-use-case'
import { PrismaCarsRepository } from '@/repositories/prisma/prisma-cars-repository'

const carsRepository = new PrismaCarsRepository()

export function MakeCreateCarUseCase() {
  const createCarUseCase = new CreateCarUseCase(carsRepository)

  return createCarUseCase
}
